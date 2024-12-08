import { Typography } from "@/app/components/materialTailwind";
import SkillCard from "@/app/components/dashboard/skill-card";
import { CiHashtag } from "react-icons/ci";
import { FaEye, FaFingerprint } from "react-icons/fa6";
import { HiMiniRectangleGroup, HiSwatch } from "react-icons/hi2";
import { IoDocumentText } from "react-icons/io5";

export default function Skills() {
  const SIZEICON = 20;
  const SKILLS = [
    {
      icon: <HiMiniRectangleGroup size={SIZEICON} />,
      title: "Frontend Web Development:",
      children:
        "Creating beautiful and functional web experiences is my forte. Using the latest technologies and best practices, I design and build websites that captivate and engage users.",
    },
    {
      icon: <FaFingerprint size={SIZEICON} />,
      title: "Mobile App Development",
      children:
        " I specialize in creating responsive and intuitive mobile apps that work seamlessly across iOS & Android devices. From concept to deployment, I handle every stage of the development process.",
    },
    {
      icon: <HiSwatch size={SIZEICON} />,
      title: "Technology Stack",
      children:
        "I'm well-versed in the industry's most popular frontend technologies, including HTML5, CSS3, JavaScript, and frameworks like React and React Native.",
    },
    {
      icon: <CiHashtag size={SIZEICON} />,
      title: " Web Optimization",
      children:
        "Performance matters. I optimize websites and apps for speed, ensuring your users enjoy a fast and responsive experience, which in turn boosts user satisfaction and SEO rankings.",
    },
    {
      icon: <FaEye size={SIZEICON} />,
      title: "User-Centric Design",
      children:
        "My development goes hand-in-hand with an eye for design. I create user interfaces that are not only functional but also aesthetically pleasing, providing a seamless and enjoyable user journey.",
    },
    {
      icon: <IoDocumentText size={SIZEICON} />,
      title: "Testing and Quality Assurance",
      children:
        "I rigorously test and debug applications to guarantee a bug-free and secure environment for users. Your peace of mind is as important to me as the functionality of your project.",
    },
  ];

  return (
    <section className="px-8">
      <div className="container mx-auto mb-20 text-center">
        <Typography
          color="blue-gray"
          className="mb-2 font-bold uppercase"
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          my skills
        </Typography>
        <Typography
          variant="h1"
          color="blue-gray"
          className="mb-4"
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          What I do
        </Typography>
        <Typography
          variant="lead"
          className="mx-auto w-full !text-gray-500 lg:w-10/12"
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          I&apos;m not just a developer; I&apos;m a digital dreamweaver.
          Crafting immersive online experiences is not just a job but my
          calling. Discover below how I can help you.
        </Typography>
      </div>
      <div className="container grid grid-cols-1 mx-auto gap-y-10 md:grid-cols-2 lg:grid-cols-3">
        {SKILLS.map((props, idx) => (
          <SkillCard key={idx} {...props} />
        ))}
      </div>
    </section>
  );
}
