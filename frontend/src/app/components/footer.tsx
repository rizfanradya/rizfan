import { Typography, Button } from "@/app/components/materialTailwind";

export default function Footer() {
  const LINKS = ["Home", "About Us", "Blog", "Service"];
  const CURRENT_YEAR = new Date().getFullYear();

  return (
    <footer className="px-8 pt-20 mt-10">
      <div className="container mx-auto">
        <div className="flex flex-wrap items-center justify-center py-6 mt-16 border-t border-gray-200 gap-y-4 md:justify-between">
          <Typography
            className="text-center font-normal !text-gray-700"
            placeholder={undefined}
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
          >
            &copy; {CURRENT_YEAR} Made with{" "}
            <a href="https://www.material-tailwind.com" target="_blank">
              Material Tailwind
            </a>{" "}
            by{" "}
            <a href="https://www.creative-tim.com" target="_blank">
              Creative Tim
            </a>
            .
          </Typography>
          <ul className="flex items-center gap-8">
            {LINKS.map((link) => (
              <li key={link}>
                <Typography
                  as="a"
                  href="#"
                  variant="small"
                  className="font-normal text-gray-700 transition-colors hover:text-gray-900"
                  placeholder={undefined}
                  onPointerEnterCapture={undefined}
                  onPointerLeaveCapture={undefined}
                >
                  {link}
                </Typography>
              </li>
            ))}
            <Button
              color="gray"
              placeholder={undefined}
              onPointerEnterCapture={undefined}
              onPointerLeaveCapture={undefined}
            >
              subscribe
            </Button>
          </ul>
        </div>
      </div>
    </footer>
  );
}
