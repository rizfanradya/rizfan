"use client";
import { auth } from "@/utils/firebase";
import { signInWithEmailAndPassword } from "firebase/auth";
import { useRouter } from "next/navigation";
import { useEffect, useState } from "react";
import { SubmitHandler, useForm } from "react-hook-form";

type inputs = {
  email: string;
  password: string;
};

export default function LoginAdmin() {
  const router = useRouter();
  const { register, handleSubmit } = useForm<inputs>();
  const [buttonSubmit, setButtonSubmit] = useState<boolean>(false);
  const [invalidEmail, setInvalidEmail] = useState<boolean>(false);
  const [wrongPassword, setWrongPassword] = useState<boolean>(false);

  useEffect(() => {
    function sessionLogin() {
      auth.onAuthStateChanged((user) => {
        if (user) router.push(`/admin`);
      });
    }
    sessionLogin();
  }, [router]);

  const handleLogin: SubmitHandler<inputs> = async ({ email, password }) => {
    setButtonSubmit(true);
    try {
      await signInWithEmailAndPassword(auth, email, password);
      setButtonSubmit(false);
      router.push(`/admin`);
      closeToast();
    } catch (error: any) {
      if (error.code === `auth/invalid-email`) {
        setInvalidEmail(true);
        setButtonSubmit(false);
        closeToast();
      } else if (error.code === `auth/invalid-credential`) {
        setWrongPassword(true);
        setButtonSubmit(false);
        closeToast();
      } else {
        setButtonSubmit(false);
        alert(`server error`);
      }
    }
  };

  function closeToast() {
    setTimeout(() => {
      setInvalidEmail(false);
      setWrongPassword(false);
    }, 2000);
  }

  return (
    <div className="w-screen h-screen flex items-center justify-center">
      {invalidEmail && (
        <div className="toast toast-top toast-center">
          <div className="alert alert-error font-semibold text-lg">
            EMAIL TIDAK TERDAFTAR !!
          </div>
        </div>
      )}
      {wrongPassword && (
        <div className="toast toast-top toast-center">
          <div className="alert alert-error font-semibold text-lg">
            PASSWORD SALAH !!
          </div>
        </div>
      )}

      <div className="card bg-base-100 shadow-xl p-4 w-96 mx-4">
        <h1 className="pt-4 pb-6 font-semibold text-2xl tracking-wide text-center">
          LOGIN ADMIN
        </h1>

        <form
          onSubmit={handleSubmit(handleLogin)}
          className="flex flex-col gap-6"
        >
          <input
            className="input input-bordered input-primary"
            placeholder="Email"
            type="text"
            required
            {...register("email", { required: true })}
          />

          <input
            className="input input-bordered input-primary"
            placeholder="Password"
            type="password"
            required
            {...register("password", { required: true })}
          />

          {buttonSubmit ? (
            <div className="btn btn-neutral mt-4">
              <span className="loading loading-spinner"></span>
            </div>
          ) : (
            <button className="btn btn-accent mt-4">SIGN IN</button>
          )}
        </form>
      </div>
    </div>
  );
}
