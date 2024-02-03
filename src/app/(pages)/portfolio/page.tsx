import PortfolioCard from "./portfolioCard";
import HeaderFooter from "@/app/headerFooter";

export default function Portfolio() {
  return (
    <HeaderFooter>
      <div id="portfolio" className="pt-28 grid gap-10 justify-center">
        <h1 className="text-center text-4xl font-semibold">My Portfolio</h1>
        <div className="flex flex-wrap justify-center gap-3">
          <PortfolioCard />
        </div>
      </div>
    </HeaderFooter>
  );
}
