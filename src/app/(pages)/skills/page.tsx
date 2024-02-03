import HeaderFooter from "@/app/headerFooter";
import Image from "next/image";

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

export default function Skills() {
  return (
    <HeaderFooter>
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
    </HeaderFooter>
  );
}
