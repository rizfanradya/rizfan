#include <iostream>
#include <ctime>

using namespace std;

void hitung_usia()
{
  cout << "===================================" << endl;
  cout << "HITUNG USIA" << endl;
  cout << "===================================" << endl;

  int tahun_lahir;
  cout << "Masukkan tahun lahir Anda: ";
  cin >> tahun_lahir;

  time_t sekarang = time(0);
  tm *waktu = localtime(&sekarang);
  int tahun_sekarang = 1900 + waktu->tm_year;

  cout << "Tahun sekarang: " << tahun_sekarang << endl;

  if (tahun_sekarang >= tahun_lahir)
  {
    int usia = tahun_sekarang - tahun_lahir;
    cout << "Usia Anda adalah: " << usia << " tahun" << endl;
  }
  else
  {
    cout << "Tahun lahir tidak valid!" << endl;
  }
}
