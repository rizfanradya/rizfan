import Footer from "@/app/components/dashboard/footer";
import Clients from "./clients";
import ContactForm from "./contact-form";
import Hero from "./hero";
import PopularClients from "./popular-client";
import Projects from "./projects";
import Resume from "./resume";
import Skills from "./skills";
import Testimonial from "./testimonial";

export default function Dashboard() {
  return (
    <>
      <Hero />
      <Clients />
      <Skills />
      <Projects />
      <Resume />
      <Testimonial />
      <PopularClients />
      <ContactForm />
      <Footer />
    </>
  );
}
