import { firestore, storage } from "@/utils/firebase";
import { deleteDoc, doc } from "firebase/firestore";
import { deleteObject, ref } from "firebase/storage";
import { useState } from "react";
import { MdDelete } from "react-icons/md";

export default function DeletePortfolio({
  image,
  id,
}: {
  image: string;
  id: string;
}) {
  const [buttonSubmit, setButtonSubmit] = useState<boolean>(false);
  async function handleDelete() {
    setButtonSubmit(true);
    try {
      await deleteObject(ref(storage, image));
      await deleteDoc(doc(firestore, "portfolio", id));
      setButtonSubmit(false);
      window.location.reload();
    } catch (error) {
      console.log(error);
      setButtonSubmit(false);
      alert(`server error`);
      window.location.reload();
    }
  }

  return (
    <>
      {buttonSubmit ? (
        <div className="btn btn-neutral button-action">
          <span className="loading loading-spinner"></span>
        </div>
      ) : (
        <span
          onClick={() => handleDelete()}
          className="btn btn-neutral button-action"
        >
          <MdDelete size="1.2em" /> Delete
        </span>
      )}
    </>
  );
}
