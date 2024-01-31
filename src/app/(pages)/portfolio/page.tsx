import Link from "next/link";
import CardPortfolio from "./cardPortfolio";

export default function Portfolio() {
  return (
    <div>
      <div className="fixed bg-base-100 navbar z-50">
        <Link href={"/"} className="btn">
          {"<< GO BACK"}
        </Link>
      </div>

      <div className="py-20 px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 2xl:grid-cols-5 gap-4">
        <CardPortfolio />
      </div>
    </div>
  );
}
