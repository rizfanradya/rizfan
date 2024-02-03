import ContactForm from "./contactForm";
import HeaderFooter from "@/app/headerFooter";

export default function Contact() {
  return (
    <HeaderFooter>
      <div id="contact" className="py-28 grid gap-10 justify-center">
        <h1 className="text-center text-4xl font-semibold">Contact Me</h1>
        <ContactForm />
      </div>
    </HeaderFooter>
  );
}
