var game = new Phaser.Game(800, 600, Phaser.CANVAS, ' ');

var player;
var backgroundImg;
var restartImg;
var backgroundVel;
var cursors;
var pConsumerObject;
var predatorObject;

// HUD
var level = 1;
var score = 0;
var scoreText;
var levelText;
var gameOverText;
var changeLevel = 0;

var mainState = {
  preload: function () {
    game.load.image('background', 'assets/imgs/bg.png');
    game.load.image('player', 'assets/imgs/player.png');
    game.load.image('pConsumers', 'assets/imgs/enemy.png');
    game.load.image('predators', 'assets/imgs/predator.png');
    game.load.image('restart', 'assets/imgs/restartBtn.png');
  },

  create: function () {

    // BACKGROUND
    backgroundImg = game.add.tileSprite(0, 0, 800, 600, 'background');
    backgroundVel = 1;

    // RESTART BUTTON
    restartImg = game.add.button(420, 300, 'restart');
    restartImg.anchor.setTo(0.5, 0.5);
    restartImg.width = 40;
    restartImg.height = 40;
    restartImg.visible = false;
    restartImg.inputEnabled = true;

    // PLAYER
    player = game.add.sprite(20, game.world.centerY - 50, 'player');
    game.world.setBounds(0, 0, 800, 500);

    // PRIMARY CONSUMERS
    pConsumerObject = game.add.group();
    pConsumerObject.enableBody = true;
    pConsumerObject.PhysicsBodyType = Phaser.Physics.ARCADE;
    primaryConsumers();

    // PREDATORS
    predatorObject = game.add.group();
    predatorObject.enableBody = true;
    predatorObject.PhysicsBodyType = Phaser.Physics.ARCADE;
    predators();

    // PHYSICS
    game.physics.enable(player, Phaser.Physics.ARCADE);

    // BOUNDS OF THE WORLD
    player.body.collideWorldBounds = true;
    cursors = game.input.keyboard.createCursorKeys();

    scoreHandler();
  },

  update: function () {

    // SCROLLING BACKGROUND
    backgroundImg.tilePosition.x -= backgroundVel;

    // PLAYER HANDLER
    playerMoveHandler();

    // LEVEL HANDLER
    levelHandler();

    // COLLISION HANDLERS
    game.physics.arcade.overlap(player, pConsumerObject, collisionPCHandler, null, this);
    game.physics.arcade.overlap(player, predatorObject, collisionPPHandler, null, this);
  },
};

game.state.add('mainState', mainState);
game.state.start('mainState');

// PLAYER HANDLER
function playerMoveHandler() {
  player.body.velocity.x = 0;
  player.body.velocity.y = 0;

  if (cursors.left.isDown) {
    player.body.velocity.x = -350;
  }

  if (cursors.right.isDown) {
    player.body.velocity.x = 350;
  }

  if (cursors.up.isDown) {
    player.body.velocity.y = -350;
  }

  if (cursors.down.isDown) {
    player.body.velocity.y = 350;
  }
};

// SCORE KEEPER HANDLER
function scoreKeeperHandler() {
  score += 1;
  scoreText.text = 'Score: ' + score;
};

// PRIMARY CONSUMERS
function primaryConsumers() {
  var object = pConsumerObject.create(830, randomY(), 'pConsumers');
  object.anchor.setTo(0.5, 0.5);
  object.body.velocity.x = -90;
};

// PREDATORS
function predators() {
  var object = predatorObject.create(830, randomY(), 'predators');
  object.anchor.setTo(0.5, 0.5);
  object.body.velocity.x = -100;
};

// COLLISION DETECTION B/T PLAYER AND PRIMARY CONSUMERS
function collisionPCHandler(player, consumer) {
  consumer.kill();
  scoreKeeperHandler();
  primaryConsumers();
}

function collisionPPHandler(player, predator) {
  player.visible = false;
  restart();
}

function levelHandler() {

  var tween;
  changeLevel++;
  if (changeLevel >= 900) {
    changeLevel = 0;
    level++;
    levelText.text = 'Level: ' + level;
  };

  if (level === 1) {
    tween = game.add.tween(predatorObject).to({ y: 100 }, 800, Phaser.Easing.Quadratic.InOut, true, 0, 1000, true);
    tween = game.add.tween(predatorObject).to( { y: game.world.height - predatorObject.height }, 1500, Phaser.Easing.Bounce.Out, true, 2500, 10);

    tween = game.add.tween(pConsumerObject).to({
      y: 100,
    }, 800, Phaser.Easing.Quadratic.InOut, true, 0, 1000, true);
  } else if (level === 2) {
    tween = game.add.tween(predatorObject).to({
      y: 200,
    }, 1500, Phaser.Easing.Elastic.Out, true, 10, 2000, true);
    tween = game.add.tween(pConsumerObject).to({
      y: 200,
    }, 1500, Phaser.Easing.Elastic.Out, true, 10, 2000, true);
  } else if (level === 3) {
    tween = game.add.tween(predatorObject).to({
      y: 200,
    }, 1500, Phaser.Easing.Bounce.Out, true, 10, 2000, true);
    tween = game.add.tween(pConsumerObject).to({
      y: 200,
    }, 1500, Phaser.Easing.Bounce.Out, true, 10, 2000, true);
  }

}

function scoreHandler() {
  // SCORE
  scoreText = game.add.text(680, 10, 'Score: ' + score,
    {
      font: '20px Arial',
      fontWeight: '900',
      fill: 'red',
    }
  );

  levelText = game.add.text(590, 10, 'Level: ' + level,
    {
      font: '20px Arial',
      fontWeight: '900',
      fill: 'red',
    }
  );

  gameOverText = game.add.text(280, 100, 'Game Over',
    {
      font: '50px Arial',
      fontWeight: '900',
      fill: 'Black',
    }
  );

  scoreText.visible = true;
  levelText.visible = true;
  gameOverText.visible = false;
}

function randomY() {
  var y = Math.floor(Math.floor(Math.random() * 400) + 15);
  return y;
}

function restart() {
  scoreText.visible = false;
  levelText.visible = false;
  gameOverText.visible = true;
  restartImg.visible = true;

  scoreText = game.add.text(370, 180, 'Score: ' + score,
    {
      font: '25px Arial',
      fontWeight: '900',
      fill: 'Black',
    }
  );
  levelText = game.add.text(370, 230, 'Level: ' + level,
    {
      font: '25px Arial',
      fontWeight: '900',
      fill: 'Black',
    }
  );

  restartImg.events.onInputDown.add(function () {
    level = 1;
    levelText.text = 'Level: ' + level;
    score = 0;
    scoreText.text = 'Level: ' + score;
    scoreText.visible = false;
    levelText.visible = false;
    gameOverText.visible = false;
    scoreHandler();
    restartImg.visible = false;
    player.visible = true;
  }, this);
}
