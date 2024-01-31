/* eslint-disable react-hooks/rules-of-hooks */
import { collection, onSnapshot } from "firebase/firestore";
import { firestore } from "./firebase";
import { useState, useEffect } from "react";

export function retrieveData(collectionName: string) {
  const [data, setData] = useState([]);
  useEffect(() => {
    const collectionRef = collection(firestore, collectionName);
    const unsubscribe = onSnapshot(collectionRef, (querySnapshot) => {
      const response: any = querySnapshot.docs.map((doc) => ({
        id: doc.id,
        ...doc.data(),
      }));
      setData(response);
    });
    return () => {
      unsubscribe();
    };
  }, [collectionName]);
  return data;
}
