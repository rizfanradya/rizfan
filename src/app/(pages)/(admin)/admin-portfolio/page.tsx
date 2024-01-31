"use client";
import { retrieveData } from "@/utils/retrieveData";
import AdminLayout from "../adminLayout";
import AddPortfolio from "./addPortfolio";
import Image from "next/image";
import { useEffect, useState } from "react";
import { MdDelete } from "react-icons/md";
import DeletePortfolio from "./deletePortfolio";

export default function AdminPortfolio() {
  const [getData, setGetData] = useState<any>([]);
  const [selectedUser, setSelectedUser] = useState<any>(null);
  const [isEditButtonVisible, setEditButtonVisible] = useState<boolean>(false);
  const [clickedRowIndex, setClickedRowIndex] = useState<number | null>(null);

  useEffect(() => {
    async function fetch() {
      const data = await retrieveData("portfolio");
      setGetData(data);
    }
    fetch();
  }, []);

  const handleEditClick = (doc: any, index: number) => {
    setSelectedUser(doc);
    setEditButtonVisible(true);
    setClickedRowIndex(index);
  };
  const handleClickOutsideTable = (event: MouseEvent) => {
    const clickedElement = event.target as HTMLElement;
    if (
      !clickedElement.closest("tr") &&
      !clickedElement.closest(".button-action")
    ) {
      setEditButtonVisible(false);
      setClickedRowIndex(null);
    }
  };
  useEffect(() => {
    document.addEventListener("click", handleClickOutsideTable);
    return () => {
      document.removeEventListener("click", handleClickOutsideTable);
    };
  }, []);

  return (
    <AdminLayout>
      <div className="mx-4">
        <div className="flex items-center gap-3">
          <AddPortfolio />
          {isEditButtonVisible ? (
            <DeletePortfolio image={selectedUser.image} id={selectedUser.id} />
          ) : (
            <span className="btn btn-disabled">
              <MdDelete size="1.2em" /> Delete
            </span>
          )}
        </div>

        <div className="overflow-x-auto">
          <table className="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Link Site</th>
                <th>Source Code</th>
              </tr>
            </thead>

            <tbody className="text-slate-200">
              {getData.map((doc: any, index: number) => (
                <tr
                  key={doc.id}
                  onClick={() => handleEditClick(doc, index)}
                  className={`hover:bg-slate-800 transition cursor-pointer ${
                    clickedRowIndex === index && "bg-slate-800"
                  }`}
                >
                  <td>{index + 1}</td>
                  <td className="avatar">
                    <span className="mask mask-squircle w-12 h-12">
                      <Image
                        src={doc.image}
                        alt={doc.title}
                        width={50}
                        height={50}
                      />
                    </span>
                  </td>
                  <td>{doc.title}</td>
                  <td>{doc.description}</td>
                  <td>{doc.linkSite}</td>
                  <td>{doc.sourceCode}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </AdminLayout>
  );
}
