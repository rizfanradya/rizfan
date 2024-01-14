import Link from "next/link";
import { RiMenu2Fill } from "react-icons/ri";

const listItem = [
  { name: "Home", href: "/" },
  { name: "About", href: "#about" },
  { name: "Skill", href: "#skill" },
  { name: "Experience", href: "#experience" },
  { name: "Portfolio", href: "#portfolio" },
  { name: "Contact", href: "#contact" },
];

export default function Navbar() {
  return (
    <div className="navbar bg-base-100 fixed">
      <div className="navbar-start">
        <div className="dropdown">
          <div tabIndex={0} role="button" className="btn btn-ghost lg:hidden">
            <RiMenu2Fill size={"2em"} />
          </div>
          <ul
            tabIndex={0}
            className="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52"
          >
            {listItem.map((doc) => (
              <li key={doc.name}>
                <Link href={doc.href}>{doc.name}</Link>
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
  );
}
