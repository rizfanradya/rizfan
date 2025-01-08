#include <iostream>
using namespace std;

void jumlah()
{
  cout << "====================================================" << endl;
  cout << "JUMLAHKAN 2 BUAH BILANGAN" << endl;
  cout << "====================================================" << endl;

  int bill1, bill2, hasil;

  cout << "Masukkan Bilangan 1: ";
  cin >> bill1;
  cout << "Masukkan Bilangan 2: ";
  cin >> bill2;

  hasil = bill1 + bill2;

  cout << "Hasil Jumlah Adalah = " << hasil << endl;
}
