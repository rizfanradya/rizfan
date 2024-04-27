"use client";
import { useForm } from "@formspree/react";

export default function ContactForm() {
  const formspreeEndpoint = process.env.NEXT_PUBLIC_FORMSPREE ?? "";
  const [state, handleSubmit] = useForm(formspreeEndpoint);
  if (state.succeeded) {
    alert("pesan anda telah terkirim !!");
    window.location.reload();
  }

  return (
    <form onSubmit={handleSubmit} className="grid grid-cols-1 gap-4 sm:w-96">
      <input
        className="input input-bordered input-sm"
        placeholder="Your Name"
        type="text"
        name="name"
        required
      />
      <input
        className="input input-bordered input-sm"
        placeholder="Your Email"
        type="email"
        name="email"
        required
      />
      <textarea
        className="textarea"
        placeholder="Message"
        name="message"
        required
      />
      <button className="btn btn-success text-white">Send Message</button>
    </form>
  );
}
