#include<iostream>
using namespace std;

int main () {
    int a, b;
    
    a = 5;
    b = 10;
    
    b += a;
    cout << "Hasil dari B += A = " << b << endl;

    b -= a;
    cout << "Hasil dari B -= A = " << b << endl;

    b *= a;
    cout << "Hasil dari B *= A = " << b << endl;

    b /= a;
    cout << "Hasil dari B /= A = " << b << endl;

    b %= a;
    cout << "Hasil dari B %= A = " << b << endl;
}