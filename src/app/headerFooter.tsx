import { ReactNode } from "react";
import Image from "next/image";
import Link from "next/link";
import { FaGithubSquare } from "react-icons/fa";
import { RiMenu2Fill } from "react-icons/ri";

const listItem = [
  { name: "Home", href: "/" },
  { name: "About", href: "#about" },
  { name: "Skill", href: "#skill" },
  { name: "Experience", href: "#experience" },
  { name: "Portfolio", href: "#portfolio" },
  { name: "Contact", href: "#contact" },
];

export default function HeaderFooter({ children }: { children: ReactNode }) {
  return (
    <>
      <div className="navbar bg-base-100 fixed z-50">
        <div className="navbar-start">
          <div className="dropdown">
            <div tabIndex={0} role="button" className="btn btn-ghost lg:hidden">
              <RiMenu2Fill size={"2em"} />
            </div>
            <ul
              tabIndex={0}
              className="menu menu-sm dropdown-content mt-3 z-10 p-2 shadow bg-base-100 rounded-box w-52"
            >
              {listItem.map((doc) => (
                <li key={doc.name}>
                  <Link className="p-4" href={doc.href}>
                    {doc.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>
          <Link href={"/"} className="btn btn-ghost text-xl">
            Rizfan
          </Link>
        </div>

        <div className="navbar-center hidden lg:flex">
          <ul className="menu menu-horizontal px-1">
            {listItem.map((doc) => (
              <li key={doc.name}>
                <Link href={doc.href}>{doc.name}</Link>
              </li>
            ))}
          </ul>
        </div>
      </div>

      <div className="px-4">{children}</div>

      <footer className="footer items-center p-4 bg-neutral text-neutral-content mt-20">
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
    </>
  );
}
