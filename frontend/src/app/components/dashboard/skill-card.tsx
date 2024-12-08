import { Card, CardBody, Typography } from "@/app/components/materialTailwind";
import { ReactNode } from "react";

export default function SkillCard({
  icon,
  title,
  children,
}: {
  icon: ReactNode;
  title: string;
  children: ReactNode;
}) {
  return (
    <Card
      color="transparent"
      shadow={false}
      placeholder={undefined}
      onPointerEnterCapture={undefined}
      onPointerLeaveCapture={undefined}
    >
      <CardBody
        className="grid justify-center text-center"
        placeholder={undefined}
        onPointerEnterCapture={undefined}
        onPointerLeaveCapture={undefined}
      >
        <div className="mx-auto mb-6 grid h-12 w-12 place-items-center rounded-full bg-gray-900 p-2.5 text-white shadow">
          {icon}
        </div>
        <Typography
          variant="h5"
          color="blue-gray"
          className="mb-2"
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          {title}
        </Typography>
        <Typography
          className="px-8 font-normal !text-gray-500"
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          {children}
        </Typography>
      </CardBody>
    </Card>
  );
}
