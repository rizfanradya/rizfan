"use client";
import { Typewriter } from "react-simple-typewriter";

export default function TypewriterEffect() {
  return (
    <div className="text-primary text-xl font-semibold">
      <Typewriter
        words={[
          "Rizfan Radya",
          "Full-Stack Web Developer",
          "Full-Time Freelancer",
        ]}
        loop={true}
        cursor
      />
    </div>
  );
}
