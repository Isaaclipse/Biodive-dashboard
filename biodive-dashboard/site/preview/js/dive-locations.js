$(document).ready(()=> {

  $(`.pin1`).on(`click`, () => {
     changeText("Las Perlas and Culebra!");
     showVRInstructionsPage();
 });

   $(`.pin2`).on(`click`, () => {
     changeText("Senegal and Cape Verde!");
     showVRInstructionsPage();
   });

   $(`.pin3`).on(`click` , () => {
     changeText("Solomon Islands and <br> Papa New Guinea!");
     showVRInstructionsPage();
   })

   showVRInstructionsPage = () => {
     $(`.vr-instructions`).show();
     setTimeout(() => {
       $(`.next-button`).show();
     }, 5000);
   };
 
     changeText = (value) => {
         $(".instruction-page1 > p").html("Your vessel is ready, scientist.<br/>It's time to set sail. Let's head over to " + value);        
     }
 });
