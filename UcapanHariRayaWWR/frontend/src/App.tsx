/* eslint-disable react-hooks/purity */
/* eslint-disable @typescript-eslint/no-explicit-any */
import { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";

export default function App() {
  const [name, setName] = useState("");
  const [started, setStarted] = useState(false);
  const [slide, setSlide] = useState(0);
  const [direction, setDirection] = useState(1);

  useEffect(() => {
    if (started) {
      const audio = new Audio("/music.mp3");
      audio.loop = true;
      audio.volume = 0.5;
      audio.play().catch(() => {});
    }
  }, [started]);

  if (!started) {
    return (
      <div className="min-h-screen relative flex items-center justify-center bg-gradient-to-b from-green-900 via-green-800 to-green-950 text-white overflow-hidden">
        {/* 🌙 Bulan */}
        <div className="absolute top-20 right-20 w-32 h-32 bg-yellow-300 rounded-full blur-2xl opacity-70 animate-pulse" />

        {/* ✨ Bintang */}
        <div className="absolute inset-0 pointer-events-none">
          {[...Array(30)].map((_, i) => (
            <div
              key={i}
              className="absolute w-1 h-1 bg-white rounded-full opacity-70 animate-ping"
              style={{
                top: Math.random() * 100 + "%",
                left: Math.random() * 100 + "%",
                animationDuration: 2 + Math.random() * 3 + "s",
              }}
            />
          ))}
        </div>

        {/* 💡 Lampu gantung */}
        <div className="absolute top-0 left-1/4 flex flex-col items-center animate-bounce">
          <div className="w-1 h-20 bg-yellow-200" />
          <div className="w-6 h-6 bg-yellow-400 rounded-full shadow-lg" />
        </div>

        <div className="absolute top-0 right-1/4 flex flex-col items-center animate-bounce delay-300">
          <div className="w-1 h-24 bg-yellow-200" />
          <div className="w-6 h-6 bg-yellow-400 rounded-full shadow-lg" />
        </div>

        {/* 🕌 Siluet masjid */}
        <div className="absolute bottom-0 w-full h-40 bg-gradient-to-t from-black/70 to-transparent" />

        {/* 🎉 Konten utama */}
        <div className="relative text-center z-10">
          <h1 className="text-4xl font-bold mb-6">
            🌙 Selamat Hari Raya Idul Fitri
          </h1>

          <p className="mb-6 opacity-90 max-w-md mx-auto">
            Klik tombol di bawah untuk membuka ucapan spesial dari Wong Wong
            Ruwet 💚
          </p>

          <button
            onClick={() => setStarted(true)}
            className="text-lg px-8 py-4 rounded-2xl bg-green-600 hover:bg-green-700 shadow-2xl transition"
          >
            Buka Ucapan ✨
          </button>
        </div>
      </div>
    );
  }

  const slides = [
    {
      bg: "bg-[url('/1.jpg')] bg-cover bg-center",
      content: (
        <>
          <h1 className="text-4xl font-bold mb-4">🌙 Pembuka</h1>

          <p className="mb-2">
            Selamat Hari Raya Idul Fitri 1446 H. Semoga hari yang suci ini
            membawa kedamaian, kebahagiaan, dan keberkahan yang melimpah untuk
            kita semua.
          </p>
          <p className="mb-2 text-sm opacity-90">
            Happy Eid al-Fitr 1446 H. May this blessed day bring peace,
            happiness, and abundant blessings to all of us.
          </p>
          <p className="mb-4 text-sm opacity-90">
            Sugeng Riyadi Idul Fitri 1446 H. Mugi dinten suci menika nggawa
            tentrem, kabagyan, lan berkah ingkang kathah kangge kita sedaya.
          </p>

          <div className="text-left mt-4">
            <label className="block text-sm font-medium mb-1">
              Ketik username
            </label>

            <input
              type="text"
              placeholder="Masukkan username..."
              value={name}
              onChange={(e) => setName(e.target.value)}
              className="w-full p-3 rounded-lg border text-black focus:outline-none focus:ring-2 focus:ring-green-500"
            />
          </div>
        </>
      ),
    },
    {
      bg: "bg-[url('/2.jpg')] bg-cover bg-center",
      content: (
        <>
          <h2 className="text-3xl font-semibold mb-4">✨ Isi</h2>

          <p className="mb-3">
            Semoga setiap langkah ke depan dipenuhi kebaikan, kemudahan, dan
            keberkahan. Semoga amal ibadah kita di bulan Ramadan diterima, dan
            kita dipertemukan kembali dengan Ramadan berikutnya dalam keadaan
            yang lebih baik.
          </p>

          <p className="text-sm opacity-90 mb-3">
            May every step forward be filled with kindness, ease, and blessings.
            May all our worship during Ramadan be accepted, and may we be
            reunited with the next Ramadan in a better state.
          </p>

          <p className="text-sm opacity-90 mb-4">
            Mugi saben lampah kita kaparingan kabecikan lan berkah. Mugi amal
            ibadah kita dipun tampi lan kita saged pinanggih malih kaliyan
            Ramadan ingkang langkung sae.
          </p>

          <p className="mb-3">
            Terima kasih telah menjadi bagian dari Wong Wong Ruwet. Kebersamaan
            kecil ini adalah cerita indah yang akan selalu kita ingat.
          </p>

          <p className="text-sm opacity-90 mb-3">
            Thank you for being part of Wong Wong Ruwet. These small moments are
            memories we will always cherish.
          </p>

          <p className="text-sm opacity-90 mb-4">
            Matur nuwun sampun dados bagian saking Wong Wong Ruwet. Kebersamaan
            menika badhe tansah kelingan.
          </p>

          <p className="font-semibold">
            Taqabbalallahu minna wa minkum. Mohon maaf lahir dan batin 🙏
          </p>

          <p className="text-sm opacity-90">
            May Allah accept our deeds. Forgive us 🙏
          </p>

          <p className="text-sm opacity-90 mb-4">
            Mugi Allah nampi amal kita. Nyuwun pangapunten 🙏
          </p>

          <a
            href="https://discord.gg/jahThvWf74"
            target="_blank"
            className="inline-block mt-4 bg-indigo-600 text-white px-6 py-3 rounded-xl"
          >
            Join Discord WWR 🚀
          </a>
        </>
      ),
    },
    {
      bg: "bg-[url('/3.jpg')] bg-cover bg-center",
      content: (
        <>
          <h2 className="text-3xl font-semibold mb-4">✨ Penutup</h2>

          <p className="mb-3">
            Di akhir perjalanan kecil ini, semoga setiap kebahagiaan yang kita
            rasakan hari ini dapat terus kita jaga dan kita bawa dalam
            langkah-langkah ke depan. Semoga hari kemenangan ini menjadi awal
            dari lembaran baru yang lebih baik, penuh kebaikan, dan keberkahan
            dalam setiap aspek kehidupan.
          </p>

          <p className="text-sm opacity-90 mb-3">
            At the end of this journey, may the happiness we feel today stay
            with us and guide our steps forward. May this day of victory become
            the beginning of a better chapter, filled with kindness and
            blessings in every part of our lives.
          </p>

          <p className="text-sm opacity-90 mb-4">
            Ing pungkasan perjalanan menika, mugi kabagyan ingkang kita raosaken
            dinten menika saged kita jaga lan dados pituduh ing saben lampah
            kita. Mugi dinten kemenangan menika dados wiwitan ingkang langkung
            sae.
          </p>

          <p className="mb-3">
            Terima kasih telah menjadi bagian dari Wong Wong Ruwet. Dari obrolan
            sederhana, candaan ringan, hingga kebersamaan yang mungkin terasa
            kecil, semuanya memiliki makna yang tidak tergantikan.
          </p>

          <p className="text-sm opacity-90 mb-3">
            Thank you for being part of Wong Wong Ruwet. From simple
            conversations to shared laughter, every moment holds a special
            meaning.
          </p>

          <p className="text-sm opacity-90 mb-4">
            Matur nuwun sampun dados bagian saking Wong Wong Ruwet. Saking
            obrolan prasaja dumugi guyu bebarengan, sedaya dados kenangan
            ingkang wigati.
          </p>

          <p className="mb-3">
            Semoga silaturahmi ini tetap terjaga, dan semoga kita semua selalu
            diberi kesehatan, rezeki, serta kesempatan untuk kembali berkumpul
            di waktu yang akan datang.
          </p>

          <p className="text-sm opacity-90 mb-3">
            May our bond remain strong, and may we always be blessed with
            health, sustenance, and the chance to gather again in the future.
          </p>

          <p className="text-sm opacity-90 mb-4">
            Mugi silaturahmi menika tansah kajaga, lan kita sedaya kaparingan
            sehat, rezeki, lan kesempatan kangge pinanggih malih.
          </p>

          <p className="font-semibold">
            Taqabbalallahu minna wa minkum. Mohon maaf lahir dan batin 🙏
          </p>

          <p className="text-sm opacity-90">
            May Allah accept our deeds. Forgive us 🙏
          </p>

          <p className="text-sm opacity-90 mb-4">
            Mugi Allah nampi amal kita. Nyuwun pangapunten 🙏
          </p>

          <a
            href="https://discord.gg/jahThvWf74"
            target="_blank"
            className="inline-block mt-4 bg-indigo-600 text-white px-6 py-3 rounded-xl"
          >
            Join Discord WWR 🚀
          </a>
        </>
      ),
    },
  ];

  const variants = {
    enter: (dir: any) => ({ x: dir > 0 ? 300 : -300, opacity: 0 }),
    center: { x: 0, opacity: 1 },
    exit: (dir: any) => ({ x: dir > 0 ? -300 : 300, opacity: 0 }),
  };

  return (
    <div className="w-screen h-screen p-4 flex items-center justify-center">
      <AnimatePresence mode="wait" custom={direction}>
        <motion.div
          key={slide}
          custom={direction}
          variants={variants}
          initial="enter"
          animate="center"
          exit="exit"
          transition={{ duration: 0.5 }}
          className="w-full h-full relative flex items-center justify-center text-white"
        >
          {/* Background layer */}
          <div
            className={`absolute inset-0 ${slides[slide].bg} blur-[2px] scale-105`}
          />

          {/* Overlay gelap */}
          <div className="absolute inset-0 bg-black/5" />

          {/* Content */}
          <div className="relative bg-black/50 backdrop-blur p-6 md:p-10 rounded-2xl max-w-xl w-full text-center max-h-[80vh] overflow-y-auto scrollbar-thin scrollbar-thumb-green-600">
            {slides[slide].content}

            <div className="flex justify-between mt-8">
              {slide > 0 ? (
                <button
                  onClick={() => {
                    setDirection(-1);
                    setSlide((s) => Math.max(s - 1, 0));
                  }}
                  className="bg-white/30 px-4 py-2 rounded-lg"
                >
                  Prev
                </button>
              ) : (
                <div />
              )}

              {slide < slides.length - 1 ? (
                <button
                  onClick={() => {
                    setDirection(1);
                    setSlide((s) => Math.min(s + 1, 2));
                  }}
                  className="bg-green-600 px-4 py-2 rounded-lg"
                >
                  Next
                </button>
              ) : (
                <div />
              )}
            </div>
          </div>
        </motion.div>
      </AnimatePresence>
    </div>
  );
}
