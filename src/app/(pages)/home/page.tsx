import Image from "next/image";
import TypewriterEffect from "./typewriter";
import Link from "next/link";
import HeaderFooter from "@/app/headerFooter";
import ContactForm from "./contactForm";

const skillLogo = [
  { name: "HTML", src: "/html.svg" },
  { name: "CSS", src: "/css.svg" },
  { name: "JAVASCRIPT", src: "/javascript.svg" },
  { name: "BOOTSTRAP", src: "/bootstrap.svg" },
  { name: "TAILWIND", src: "/tailwindcss.svg" },
  { name: "REACTJS", src: "/reactjs.svg" },
  { name: "NODEJS", src: "/nodejs.svg" },
  { name: "EXPRESSJS", src: "/expressjs.png" },
  { name: "NEXTJS", src: "/nextjs.svg" },
  { name: "MYSQL", src: "/mysql.svg" },
  { name: "MONGODB", src: "/mongodb.svg" },
  { name: "postgresql", src: "/postgresql.svg" },
  { name: "GIT", src: "/git.svg" },
];

const portfolio = [
  {
    title: "My Portfolio",
    description: "NEXTJS",
    image: "mysite.png",
    linkSite: "https://rizfan.vercel.app/",
    sourceCode: "https://github.com/rizfanradya/rizfan",
  },
  {
    title: "Web Top-up Game Online & Voucher",
    description: "NEXTJS, MYSQL, MIDTRANS, APIGAMES",
    image: "topupgame.png",
    linkSite: "https://topup-game-beta.vercel.app/",
    sourceCode: "https://github.com/rizfanradya/topup-game",
  },
];

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
              href={"#contact"}
              className="btn btn-primary w-max m-auto text-lg md:m-0"
            >
              Contact Me
            </Link>
          </div>
        </div>
      </div>

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

      <div id="skill" className="pt-28 grid gap-10 justify-center">
        <h1 className="text-center text-4xl font-semibold">My Skills</h1>
        <ul className="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-8 max-w-7xl">
          {skillLogo.map((doc) => (
            <li
              key={doc.name}
              title={doc.name.toUpperCase()}
              className="cursor-pointer text-sm font-semibold flex flex-col justify-evenly items-center gap-4"
            >
              <Image
                src={doc.src}
                alt={doc.name}
                width={50}
                height={50}
                className="w-12"
              />
              <p>{doc.name.toUpperCase()}</p>
            </li>
          ))}
        </ul>
      </div>

      <div
        id="experience"
        className="pt-28 grid gap-10 justify-center text-justify font-medium"
      >
        <h1 className="text-center text-4xl font-semibold">My Experience</h1>
        <div className="max-w-md grid gap-3 bg-base-200 p-6 rounded-md">
          <p className="text-xs text-slate-500">2023-NOW</p>
          <p className="text-sm">
            Working as a full-time freelance full stack web developer from 2023
            until now. I have completed various projects with different clients.
            I continually strive to provide the best results for clients.
          </p>
        </div>
      </div>

      <div id="portfolio" className="pt-28 grid gap-10 justify-center">
        <h1 className="text-center text-4xl font-semibold">My Portfolio</h1>
        <div className="flex flex-wrap justify-center gap-3">
          {portfolio.map((doc: any) => (
            <div
              key={doc.title}
              className="card card-compact w-80 bg-base-100 shadow-xl overflow-hidden rounded-lg"
            >
              <Link target="blank" href={doc.linkSite}>
                <figure>
                  <Image
                    src={`/portfolio/${doc.image}`}
                    alt={doc.title}
                    width={500}
                    height={500}
                    className="w-full"
                  />
                </figure>
              </Link>
              <div className="card-body">
                <h2 className="card-title">{doc.title}</h2>
                <p>Tech Stack : {doc.description}</p>
                <div className="card-actions justify-end">
                  <Link
                    href={doc.linkSite}
                    className="btn btn-primary btn-sm"
                    target="blank"
                  >
                    Demo Site
                  </Link>
                  <Link
                    href={doc.sourceCode}
                    className="btn btn-secondary btn-outline btn-sm"
                    target="blank"
                  >
                    Source Code
                  </Link>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>

      <div id="contact" className="py-28 grid gap-10 justify-center">
        <h1 className="text-center text-4xl font-semibold">Contact Me</h1>
        <ContactForm />
      </div>
    </HeaderFooter>
  );
}
