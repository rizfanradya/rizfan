import {
  Card,
  List,
  ListItem,
  ListItemPrefix,
  Typography,
} from "@material-tailwind/react";
import Link from "next/link";
import { ReactNode } from "react";

export default function Sidebar({
  linkItems,
  isActive,
}: {
  isActive: string;
  linkItems: {
    name: string;
    href: string;
    icon: ReactNode;
    role: string[];
  }[];
}) {
  return (
    <Card
      className="h-[calc(100vh-2rem)] fixed z-10 w-full max-w-72 border border-black/25 py-4 px-2 shadow-xl shadow-blue-gray-900/5 hidden lg:block overflow-auto"
      placeholder={undefined}
      onPointerEnterCapture={undefined}
      onPointerLeaveCapture={undefined}
    >
      <div className="p-4 mb-2">
        <Typography
          variant="h5"
          color="blue-gray"
          className="text-center"
          as="a"
          href="/financial-records"
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          Financial Records
        </Typography>
      </div>

      <List
        placeholder={undefined}
        onPointerEnterCapture={undefined}
        onPointerLeaveCapture={undefined}
      >
        {linkItems.map((doc) => (
          <Link href={doc.href} key={doc.href}>
            <ListItem
              placeholder={undefined}
              onPointerEnterCapture={undefined}
              onPointerLeaveCapture={undefined}
              className={`${isActive === doc.href && "text-white bg-gray-800"}`}
            >
              <ListItemPrefix
                placeholder={undefined}
                onPointerEnterCapture={undefined}
                onPointerLeaveCapture={undefined}
              >
                {doc.icon}
              </ListItemPrefix>
              <Typography
                placeholder={undefined}
                onPointerEnterCapture={undefined}
                onPointerLeaveCapture={undefined}
                className="font-bold"
              >
                {doc.name}
              </Typography>
            </ListItem>
          </Link>
        ))}
      </List>
    </Card>
  );
}
