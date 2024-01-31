"use client";
import { retrieveData } from "@/utils/retrieveData";
import Image from "next/image";
import Link from "next/link";

export default function PortfolioSection() {
  const portfolio = retrieveData("portfolio");

  return (
    <>
      {portfolio.map((doc: any) => (
        <div
          key={doc.title}
          className="card card-compact w-80 bg-base-100 shadow-xl overflow-hidden rounded-lg"
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
    </>
  );
}
