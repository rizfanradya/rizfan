import { firestore, storage } from "@/utils/firebase";
import randomFileName from "@/utils/randomFileName";
import { addDoc, collection } from "firebase/firestore";
import { getDownloadURL, ref, uploadBytes } from "firebase/storage";
import { useState } from "react";
import { SubmitHandler, useForm } from "react-hook-form";
import { IoIosAddCircle } from "react-icons/io";

type inputs = {
  title: string;
  description: string;
  linkSite: string;
  sourceCode: string;
  image: any;
};

export default function AddPortfolio() {
  const [buttonSubmit, setButtonSubmit] = useState<boolean>(false);
  const { register, handleSubmit, reset } = useForm<inputs>();
  const [modal, setModal] = useState<boolean>();

  const onSubmit: SubmitHandler<inputs> = async (e) => {
    setButtonSubmit(true);
    const image = randomFileName(e.image[0].name);
    try {
      const storageRef = ref(storage, image);
      await uploadBytes(storageRef, e.image[0]);
      const downloadURL = await getDownloadURL(storageRef);
      await addDoc(collection(firestore, "portfolio"), {
        title: e.title,
        description: e.description,
        linkSite: e.linkSite,
        sourceCode: e.sourceCode,
        image: downloadURL,
      });
      setButtonSubmit(false);
      setModal(false);
    } catch (error) {
      setButtonSubmit(false);
      alert(`server error`);
    }
  };

  return (
    <div className="my-3">
      <div onClick={() => setModal(true)} className="btn btn-neutral">
        <IoIosAddCircle size={"1.5em"} />
        Add Portfolio
      </div>

      <input type="checkbox" className="modal-toggle" checked={modal} />
      <div className="modal" role="dialog">
        <div className="modal-box">
          <h1 className="text-center text-xl font-semibold mb-8">
            Add Portfolio
          </h1>

          <form onSubmit={handleSubmit(onSubmit)} className="grid gap-4">
            <input
              className="input input-bordered input-primary w-full"
              placeholder="Title"
              type="text"
              required
              {...register("title", { required: true })}
            />

            <input
              className="input input-bordered input-primary w-full"
              placeholder="Description"
              type="text"
              required
              {...register("description", { required: true })}
            />

            <input
              className="input input-bordered input-primary w-full"
              placeholder="Link Site"
              type="text"
              required
              {...register("linkSite", { required: true })}
            />

            <input
              className="input input-bordered input-primary w-full"
              placeholder="Source Code"
              type="text"
              required
              {...register("sourceCode", { required: true })}
            />

            <input
              className="file-input file-input-bordered file-input-primary w-full"
              type="file"
              required
              {...register("image", { required: true })}
            />

            {buttonSubmit ? (
              <div className="btn btn-neutral mt-4">
                <span className="loading loading-spinner"></span>
              </div>
            ) : (
              <button className="btn btn-accent mt-4">Send</button>
            )}
          </form>
        </div>

        <div
          className="modal-backdrop cursor-pointer"
          onClick={() => {
            reset(), setModal(false);
          }}
        ></div>
      </div>
    </div>
  );
}
