"use client";
import { useState } from "react";
import { SubmitHandler, useForm } from "react-hook-form";

type Inputs = { name: string; email: string; message: string };

export default function ContactForm() {
  const { register, handleSubmit } = useForm<Inputs>();
  const [buttonSubmit, setButtonSubmit] = useState<boolean>(false);

  const onSubmit: SubmitHandler<Inputs> = async (e) => {
    try {
      setButtonSubmit(true);
      console.log(e);
      setButtonSubmit(false);
      alert("pesan anda telah dikirim !!");
      window.location.reload();
    } catch (error) {
      console.log(error);
      alert(`pesan anda "GAGAL" dikirim !!`);
      window.location.reload();
    }
  };

  return (
    <form
      onSubmit={handleSubmit(onSubmit)}
      className="grid grid-cols-1 gap-4 sm:w-96"
    >
      <input
        className="input input-bordered input-sm"
        placeholder="Your Name"
        type="text"
        required
        {...register("name", { required: true })}
      />
      <input
        className="input input-bordered input-sm"
        placeholder="Your Email"
        type="text"
        required
        {...register("email", { required: true })}
      />
      <textarea
        className="textarea"
        placeholder="Message"
        required
        {...register("message", { required: true })}
      />
      {buttonSubmit ? (
        <div className="btn btn-neutral">
          <span className="loading loading-spinner"></span>
        </div>
      ) : (
        <button className="btn btn-success text-white">Send Message</button>
      )}
    </form>
  );
}
