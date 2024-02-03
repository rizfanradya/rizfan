import HeaderFooter from "@/app/headerFooter";
import Image from "next/image";

export default function About() {
  return (
    <HeaderFooter>
      <div className="text-justify font-medium pt-28 grid gap-12" id="about">
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
              I also provide services related to web programming on a freelance
              basis. I have completed several projects from different clients, I
              always try to provide the best results for clients.
            </p>
          </div>
        </div>
      </div>
    </HeaderFooter>
  );
}
