const app = document.getElementById("typewriter");

const typewriter = new Typewriter(app, {
  loop: true,
  delay: 100,
});

const pause = 1000;
const text1 = "Rizfan Radya";
const text2 = "Full-Stack Web Developer";
const text3 = "Full-Time Freelancer";

typewriter
  .pauseFor(pause)
  .typeString(text1)
  .pauseFor(pause)
  .deleteChars(text1.length)
  .typeString(text2)
  .pauseFor(pause)
  .deleteChars(text2.length)
  .typeString(text3)
  .pauseFor(pause)
  .deleteChars(text3.length)
  .pauseFor(pause)
  .start();
