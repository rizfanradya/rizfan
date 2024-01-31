import { retrieveData } from "@/utils/retrieveData";
import Image from "next/image";
import Link from "next/link";

export default async function Portfolio() {
  const portfolio = await retrieveData("portfolio");

  return (
    <div>
      <div className="fixed bg-base-100 navbar z-50">
        <Link href={"/"} className="btn">
          {"<< GO BACK"}
        </Link>
      </div>

      <div className="py-20 px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 2xl:grid-cols-5 gap-4">
        {portfolio.map((doc: any, i) => (
          <div
            key={i}
            className="card card-compact bg-base-100 shadow-xl overflow-hidden rounded-lg"
          >
            <Link target="blank" href={doc.linkSite}>
              <figure>
                <Image
                  src={doc.image}
                  alt={doc.title}
                  width={500}
                  height={500}
                  className="w-full"
                />
              </figure>
            </Link>
            <div className="card-body">
              <h2 className="card-title">{doc.title}</h2>
              <p>Tech Stack : {doc.description}</p>
              <div className="card-actions justify-end">
                <Link
                  href={doc.linkSite}
                  className="btn btn-primary btn-sm"
                  target="blank"
                >
                  Demo Site
                </Link>
                <Link
                  href={doc.sourceCode}
                  className="btn btn-secondary btn-outline btn-sm"
                  target="blank"
                >
                  Source Code
                </Link>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
