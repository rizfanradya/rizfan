import Image from "next/image";
import Link from "next/link";
import { FaGithubSquare } from "react-icons/fa";

export default function Footer() {
  return (
    <footer className="footer items-center p-4 bg-neutral text-neutral-content">
      <aside className="items-center grid-flow-col">
        <Image src={"/footer.svg"} alt="footer" width={50} height={50} />
        <p>
          Copyright © 2024 Rizfan Radya - All right reserved -
          rizfankusuma@gmail.com
        </p>
      </aside>
      <nav className="grid-flow-col gap-4 md:place-self-center md:justify-self-end">
        <Link href={"https://github.com/rizfanradya"} target="blank">
          <FaGithubSquare size={"3em"} />
        </Link>
      </nav>
    </footer>
  );
}
