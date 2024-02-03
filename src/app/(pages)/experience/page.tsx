import HeaderFooter from "@/app/headerFooter";

export default function Experience() {
  return (
    <HeaderFooter>
      <div
        id="experience"
        className="pt-28 grid gap-10 justify-center text-justify font-medium"
      >
        <h1 className="text-center text-4xl font-semibold">My Experience</h1>
        <div className="max-w-md grid gap-3 bg-base-200 p-6 rounded-md">
          <p className="text-xs text-slate-500">2023-NOW</p>
          <p className="text-sm">
            Working as a full-time freelance full stack web developer from 2023
            until now. I have completed various projects with different clients.
            I continually strive to provide the best results for clients.
          </p>
        </div>
      </div>
    </HeaderFooter>
  );
}
