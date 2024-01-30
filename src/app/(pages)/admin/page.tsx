"use client";
import { auth } from "@/utils/firebase";
import { signOut } from "firebase/auth";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { FiLogOut } from "react-icons/fi";

export default function Admin() {
  const router = useRouter();
  auth.onAuthStateChanged((user) => {
    if (!user) router.push(`/login-admin`);
  });

  async function handleLogout() {
    try {
      await signOut(auth);
    } catch (error) {
      console.log(error);
    }
  }

  return (
    <>
      <div className="navbar bg-base-100">
        <div className="navbar-start">
          <Link href={"/admin"} className="btn btn-ghost text-xl">
            Admin Panel
          </Link>
        </div>
        <div className="navbar-end">
          <span onClick={() => handleLogout()} className="btn btn-neutral">
            <FiLogOut size={"1.5em"} /> Logout
          </span>
        </div>
      </div>

      <div>content</div>
    </>
  );
}
