import { collection, getDocs } from "firebase/firestore";
import { firestore } from "./firebase";

export async function retrieveData(collectionName: string) {
  const querySnapshot = await getDocs(collection(firestore, collectionName));
  const response = querySnapshot.docs.map((doc) => ({
    id: doc.id,
    ...doc.data(),
  }));
  return response;
}
