import Image from "next/image";
import { Typography } from "@/app/components/materialTailwind";

export default function PopularClients() {
  const CLIENTS = [
    "coinbase",
    "spotify",
    "pinterest",
    "google",
    "amazon",
    "netflix",
  ];

  return (
    <section className="px-8 py-8 lg:py-20">
      <div className="container grid items-center mx-auto place-items-center">
        <div className="text-center">
          <Typography
            variant="h6"
            className="mb-4 uppercase !text-gray-500"
            placeholder={undefined}
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
          >
            POPULAR CLIENTS
          </Typography>
          <Typography
            variant="h2"
            color="blue-gray"
            className="mb-4"
            placeholder={undefined}
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
          >
            Trusted by over 10,000+ <br /> clients
          </Typography>
        </div>
        <div className="flex flex-wrap items-center justify-center gap-6 mt-8">
          {CLIENTS.map((logo, key) => (
            <Image
              key={key}
              alt={logo}
              width={480}
              height={480}
              src={`/logos/logo-${logo}.svg`}
              className="w-40 opacity-75 grayscale"
            />
          ))}
        </div>
      </div>
    </section>
  );
}
