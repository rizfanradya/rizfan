import Image from "next/image";
import TypewriterEffect from "./typewriter";
import Link from "next/link";
import HeaderFooter from "@/app/headerFooter";

export default function Home() {
  return (
    <HeaderFooter>
      <div className="px-6">
        <div className="flex flex-col items-center text-center md:flex-row md:justify-evenly md:h-screen pt-10 md:pt-0">
          <Image
            src={"/main.png"}
            width={200}
            height={200}
            alt="profile"
            className="w-56 md:order-1"
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
              href={"/contact"}
              className="btn btn-primary w-max m-auto text-lg md:m-0"
            >
              Contact Me
            </Link>
          </div>
        </div>
      </div>
    </HeaderFooter>
  );
}
