import Image from "next/image";
import {
  Button,
  Card,
  CardBody,
  CardHeader,
  Typography,
} from "@/app/components/materialTailwind";
import Link from "next/link";

export default function ProjectCard({
  img,
  title,
  desc,
  href,
}: {
  img: string;
  title: string;
  desc: string;
  href: string;
}) {
  return (
    <Card
      color="transparent"
      shadow={false}
      placeholder={undefined}
      onPointerEnterCapture={undefined}
      onPointerLeaveCapture={undefined}
    >
      <CardHeader
        floated={false}
        className="h-48 mx-0 mt-0 mb-6"
        placeholder={undefined}
        onPointerEnterCapture={undefined}
        onPointerLeaveCapture={undefined}
      >
        <Image
          src={img}
          alt={title}
          width={768}
          height={768}
          className="object-cover w-full h-full"
        />
      </CardHeader>
      <CardBody
        className="p-0"
        placeholder={undefined}
        onPointerEnterCapture={undefined}
        onPointerLeaveCapture={undefined}
      >
        <Link
          href={href}
          target="_blank"
          className="transition-colors text-blue-gray-900 hover:text-gray-800"
        >
          <Typography
            variant="h5"
            className="mb-2"
            placeholder={undefined}
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
          >
            {title}
          </Typography>
        </Link>
        <Typography
          className="mb-6 font-normal !text-gray-500"
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          {desc}
        </Typography>
        <Button
          color="gray"
          size="sm"
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          <Link href={href} target="_blank">
            see details
          </Link>
        </Button>
      </CardBody>
    </Card>
  );
}
