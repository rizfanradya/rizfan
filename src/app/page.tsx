import Image from "next/image";
import Navbar from "./components/navbar";
import TypewriterEffect from "./components/typewriter";
import Link from "next/link";

export default function Home() {
  return (
    <>
      <Navbar />
      <div className="px-6">
        <div className="flex flex-col items-center text-center md:flex-row md:justify-evenly md:h-screen pt-10 md:pt-0">
          <Image
            src={"/main.png"}
            width={100}
            height={100}
            alt="profile"
            className="w-80 md:order-1"
          />
          <div className="grid gap-3 md:max-w-lg md:text-start md:gap-5">
            <p className="font-medium text-lg">Hello, i&apos;m</p>
            <TypewriterEffect />
            <p className="font-medium text-justify">
              Hi, my name Rizfan Radya i&apos;m a full stack web developer and
              welcome to my web portfolio. Here i will briefly explain about my
              self, my skills, and my experience as a full stack web
              programming.
            </p>
            <Link
              href={"#contact"}
              className="btn btn-primary w-max m-auto text-lg md:m-0"
            >
              Contact Me
            </Link>
          </div>
        </div>

        <div className="text-justify font-medium pt-24 grid gap-10" id="about">
          <h1 className="text-center text-4xl font-semibold">About Me</h1>
          <div className="flex flex-col gap-6 md:flex-row justify-around">
            <Image
              className="m-auto w-80 md:order-1 md:m-0"
              src={"/about.svg"}
              alt="about"
              width={100}
              height={100}
            />
            <div className="grid gap-4 md:max-w-xl">
              <p>
                My name is Rizfan Radya Widyan Aditya Kusuma, I graduated from
                high school in 2023, I started my IT journey when I was in high
                school, I was curious about how a system works and I started
                self-taught by reading articles, documentation, or watching
                tutorials on YouTube, and finally I focusing on mastering the
                field of Web Developer until now.
              </p>
              <p>
                I also provide services related to web programming on a
                freelance basis. I have completed several projects from
                different clients, I always try to provide the best results for
                clients.
              </p>
            </div>
          </div>
        </div>

        <div id="skill"></div>
      </div>
    </>
  );
}
