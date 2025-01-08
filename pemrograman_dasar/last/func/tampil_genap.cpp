#include <iostream>
using namespace std;

void tampil_genap()
{
  cout << "====================================================" << endl;
  cout << "TAMPILKAN BILANGAN GENAP" << endl;
  cout << "====================================================" << endl;

  int batas;
  cout << "Masukkan batas angka: ";
  cin >> batas;

  cout << "Bilangan genap dari 1 hingga " << batas << " adalah: " << endl;

  for (int i = 1; i <= batas; i++)
  {
    if (i % 2 == 0)
    {
      cout << i << " ";
    }
  }
  cout << endl;
}