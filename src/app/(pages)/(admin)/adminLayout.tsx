"use client";
import { auth } from "@/utils/firebase";
import { signOut } from "firebase/auth";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { ReactNode, useEffect } from "react";
import { FiLogOut } from "react-icons/fi";

export default function AdminLayout({ children }: { children: ReactNode }) {
  const router = useRouter();
  useEffect(() => {
    function sessionLogin() {
      auth.onAuthStateChanged((user) => {
        if (!user) router.push(`/login-admin`);
      });
    }
    sessionLogin();
  }, [router]);

  return (
    <>
      <div className="navbar bg-base-100">
        <div className="navbar-start">
          <Link href={"/admin"} className="btn btn-ghost text-xl">
            Admin Panel
          </Link>
        </div>
        <div className="navbar-end">
          <span onClick={() => signOut(auth)} className="btn btn-neutral">
            <FiLogOut size={"1.5em"} /> Logout
          </span>
        </div>
      </div>

      {children}
    </>
  );
}
