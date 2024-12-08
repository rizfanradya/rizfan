import { Typography } from "@/app/components/materialTailwind";
import ProjectCard from "@/app/components/project-card";

export default function Projects() {
  const PROJECTS = [
    {
      img: "/image/blog-1.svg",
      title: "Mobile App Development",
      desc: "Mobile app designed to help users discover and explore local restaurants and cuisines.",
      href: "https://rizfan.vercel.app",
    },
    {
      img: "/image/blog2.svg",
      title: "Landing Page Development",
      desc: "Promotional landing page for a  fitness website Summer Campaign. Form development included.",
      href: "https://rizfan.vercel.app",
    },
    {
      img: "/image/blog3.svg",
      title: "Mobile App Development",
      desc: "Mobile app designed to help users discover and explore local restaurants and cuisines.",
      href: "https://rizfan.vercel.app",
    },
    {
      img: "/image/blog4.svg",
      title: "E-commerce development",
      desc: "Ecommerce website offering  access to the latest and greatest gadgets and accessories.",
      href: "https://rizfan.vercel.app",
    },
    {
      img: "/image/blog-1.svg",
      title: "Mobile App Development",
      desc: "Mobile app designed to help users discover and explore local restaurants and cuisines.",
      href: "https://rizfan.vercel.app",
    },
    {
      img: "/image/blog2.svg",
      title: "Landing Page Development",
      desc: "Promotional landing page for a  fitness website Summer Campaign. Form development included.",
      href: "https://rizfan.vercel.app",
    },
    {
      img: "/image/blog3.svg",
      title: "Mobile App Development",
      desc: "Mobile app designed to help users discover and explore local restaurants and cuisines.",
      href: "https://rizfan.vercel.app",
    },
    {
      img: "/image/blog4.svg",
      title: "E-commerce development",
      desc: "Ecommerce website offering  access to the latest and greatest gadgets and accessories.",
      href: "https://rizfan.vercel.app",
    },
  ];

  return (
    <section className="px-8 py-28">
      <div className="container mx-auto mb-20 text-center">
        <Typography
          variant="h2"
          color="blue-gray"
          className="mb-4"
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          My Projects
        </Typography>
        <Typography
          variant="lead"
          className="mx-auto w-full px-4 font-normal !text-gray-500 lg:w-6/12"
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          Whether you have a mobile app idea that needs to come to life or a
          website that requires a facelift, I&apos;m here to turn your digital
          dreams into reality.
        </Typography>
      </div>
      <div className="container grid grid-cols-1 mx-auto gap-x-10 gap-y-20 md:grid-cols-2 xl:grid-cols-4">
        {PROJECTS.map((props, idx) => (
          <ProjectCard key={idx} {...props} />
        ))}
      </div>
    </section>
  );
}
