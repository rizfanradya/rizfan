"use client";
import { evaluate } from "mathjs";
import { useState } from "react";

export default function CalculatorCalculus() {
  const [jenisPersamaan, setJenisPersamaan] = useState("ax2+bx+c=0");
  const [metode, setMetode] = useState("rumusKuadrat");
  const [a, setA] = useState("");
  const [b, setB] = useState("");
  const [c, setC] = useState("");
  const [h, setH] = useState("");
  const [k, setK] = useState("");
  const [x1, setX1] = useState("");
  const [x2, setX2] = useState("");
  const [hasil, setHasil] = useState("");

  const hitungKuadrat = () => {
    try {
      if (jenisPersamaan === "ax2+bx+c=0") {
        if (metode === "rumusKuadrat") {
          const diskriminan = evaluate(`${b}^2 - 4 * ${a} * ${c}`);
          if (diskriminan < 0) {
            setHasil("Tidak ada solusi riil, karena diskriminan < 0.");
          } else if (diskriminan === 0) {
            const x = evaluate(`-(${b}) / (2 * ${a})`);
            setHasil(`Hasil: x = ${x}`);
          } else {
            const x1 = evaluate(
              `(-(${b}) + sqrt(${diskriminan})) / (2 * ${a})`
            );
            const x2 = evaluate(
              `(-(${b}) - sqrt(${diskriminan})) / (2 * ${a})`
            );
            setHasil(`Hasil: x1 = ${x1}, x2 = ${x2}`);
          }
        } else {
          const h = evaluate(`-(${b}) / (2 * ${a})`);
          const k = evaluate(`(4 * ${a} * ${c} - (${b})^2) / (4 * ${a})`);
          setHasil(`Bentuk Vertex: (x - ${h})² + ${k} = 0`);
        }
      } else if (jenisPersamaan === "a(x-h)^2+k=0") {
        const x1 = evaluate(`${h} - sqrt(-${k} / ${a})`);
        const x2 = evaluate(`${h} + sqrt(-${k} / ${a})`);
        setHasil(`Hasil: x1 = ${x1}, x2 = ${x2}`);
      } else if (jenisPersamaan === "a(x-x1)(x-x2)=0") {
        const b = evaluate(`-${a} * (${x1} + ${x2})`);
        const c = evaluate(`${a} * ${x1} * ${x2}`);
        setHasil(`Persamaan: ${a}x² + ${b}x + ${c} = 0`);
      }
    } catch (error) {
      console.log(error);
      setHasil("Masukkan nilai yang valid untuk perhitungan.");
    }
  };

  return (
    <div className="flex flex-col items-center min-h-screen p-6 bg-gray-100">
      <div className="max-w-xl">
        <h1 className="mb-4 text-2xl font-bold">
          Kalkulator Persamaan Kuadrat
        </h1>

        <div className="w-full mb-4">
          <label className="block mb-2 font-medium">Jenis Persamaan:</label>
          <select
            value={jenisPersamaan}
            onChange={(e) => setJenisPersamaan(e.target.value)}
            className="w-full p-2 border rounded"
          >
            <option value="ax2+bx+c=0">Ax² + Bx + C = 0</option>
            <option value="a(x-h)^2+k=0">A(x - H)² + K = 0</option>
            <option value="a(x-x1)(x-x2)=0">A(x - x1)(x - x2) = 0</option>
          </select>
        </div>

        {jenisPersamaan === "ax2+bx+c=0" && (
          <div className="w-full mb-4">
            <label className="block mb-2 font-medium">Metode:</label>
            <select
              value={metode}
              onChange={(e) => setMetode(e.target.value)}
              className="w-full p-2 border rounded"
            >
              <option value="rumusKuadrat">Rumus Kuadrat</option>
              <option value="square">Menyelesaikan Square</option>
            </select>
          </div>
        )}

        <div className="grid w-full grid-cols-3 gap-4 mb-4">
          {jenisPersamaan !== "a(x-x1)(x-x2)=0" && (
            <>
              <div>
                <label className="block mb-2 font-medium">Nilai A:</label>
                <input
                  type="number"
                  value={a}
                  onChange={(e) => setA(e.target.value)}
                  className="w-full p-2 border rounded"
                />
              </div>
            </>
          )}
          {jenisPersamaan === "ax2+bx+c=0" && (
            <>
              <div>
                <label className="block mb-2 font-medium">Nilai B:</label>
                <input
                  type="number"
                  value={b}
                  onChange={(e) => setB(e.target.value)}
                  className="w-full p-2 border rounded"
                />
              </div>
              <div>
                <label className="block mb-2 font-medium">Nilai C:</label>
                <input
                  type="number"
                  value={c}
                  onChange={(e) => setC(e.target.value)}
                  className="w-full p-2 border rounded"
                />
              </div>
            </>
          )}
          {jenisPersamaan === "a(x-h)^2+k=0" && (
            <>
              <div>
                <label className="block mb-2 font-medium">Nilai H:</label>
                <input
                  type="number"
                  value={h}
                  onChange={(e) => setH(e.target.value)}
                  className="w-full p-2 border rounded"
                />
              </div>
              <div>
                <label className="block mb-2 font-medium">Nilai K:</label>
                <input
                  type="number"
                  value={k}
                  onChange={(e) => setK(e.target.value)}
                  className="w-full p-2 border rounded"
                />
              </div>
            </>
          )}
          {jenisPersamaan === "a(x-x1)(x-x2)=0" && (
            <>
              <div>
                <label className="block mb-2 font-medium">Nilai X1:</label>
                <input
                  type="number"
                  value={x1}
                  onChange={(e) => setX1(e.target.value)}
                  className="w-full p-2 border rounded"
                />
              </div>
              <div>
                <label className="block mb-2 font-medium">Nilai X2:</label>
                <input
                  type="number"
                  value={x2}
                  onChange={(e) => setX2(e.target.value)}
                  className="w-full p-2 border rounded"
                />
              </div>
            </>
          )}
        </div>

        <button
          onClick={hitungKuadrat}
          className="w-full px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
        >
          Hitung
        </button>

        {hasil && (
          <div className="w-full p-4 mt-4 bg-green-100 border rounded">
            <strong>Hasil:</strong> {hasil}
          </div>
        )}
      </div>
    </div>
  );
}
