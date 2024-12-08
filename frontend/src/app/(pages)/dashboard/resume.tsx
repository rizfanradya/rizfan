import { Button, Typography } from "@/app/components/materialTailwind";
import ResumeItem from "@/app/components/resume-item";
import { FaArrowRightLong, FaPuzzlePiece } from "react-icons/fa6";
import { HiChartBar, HiCursorArrowRays } from "react-icons/hi2";

export default function Resume() {
  const SIZEICON = 20;
  const RESUME_ITEMS = [
    {
      icon: <HiChartBar size={SIZEICON} />,
      children: "Bachelor of Science in Computer Science",
    },
    {
      icon: <FaPuzzlePiece size={SIZEICON} />,
      children: "Certified Web Developer ",
    },
    {
      icon: <HiCursorArrowRays size={SIZEICON} />,
      children: "Frontend Framework Proficiency Certification",
    },
  ];

  return (
    <section className="px-8 py-24">
      <div className="container grid items-center w-full grid-cols-1 gap-16 mx-auto lg:grid-cols-2">
        <div className="col-span-1">
          <Typography
            variant="h2"
            color="blue-gray"
            placeholder={undefined}
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
          >
            My Resume
          </Typography>
          <Typography
            className="mb-4 mt-3 w-9/12 font-normal !text-gray-500"
            placeholder={undefined}
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
          >
            Highly skilled and creative Web Developer with 5+ years of
            experience in crafting visually stunning and functionally robust
            websites and web applications.
          </Typography>
          <Button
            variant="text"
            color="gray"
            className="flex items-center gap-2"
            placeholder={undefined}
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
          >
            view more
            <FaArrowRightLong strokeWidth={3} />
          </Button>
        </div>
        <div className="grid col-span-1 pr-0 gap-y-6 lg:ml-auto lg:pr-12 xl:pr-32">
          {RESUME_ITEMS.map((props, idx) => (
            <ResumeItem key={idx} {...props} />
          ))}
        </div>
      </div>
    </section>
  );
}
