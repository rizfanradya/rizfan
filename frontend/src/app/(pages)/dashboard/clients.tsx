import { Typography } from "@/app/components/materialTailwind";
import Image from "next/image";

export default function Clients() {
  const CLIENTS = [
    "coinbase",
    "spotify",
    "pinterest",
    "google",
    "amazon",
    "netflix",
  ];

  return (
    <section className="px-8 py-28">
      <div className="container mx-auto text-center">
        <Typography
          variant="h6"
          color="blue-gray"
          className="mb-8"
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          My awesome clients
        </Typography>
        <div className="flex flex-wrap items-center justify-center gap-6">
          {CLIENTS.map((logo, key) => (
            <Image
              key={key}
              alt={logo}
              width={768}
              height={768}
              className="w-40"
              src={`/logos/logo-${logo}.svg`}
            />
          ))}
        </div>
      </div>
    </section>
  );
}
