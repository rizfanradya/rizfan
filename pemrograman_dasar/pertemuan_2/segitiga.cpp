#include <iostream>
#include <limits>

using namespace std;

int main() {
    float alas, tinggi, luas;

    auto getInput = [](const string& prompt) -> float {
        float value;
        while (true) {
            cout << prompt;
            cin >> value;
            if (cin.fail() || value < 0) { 
                cin.clear(); 
                cin.ignore(numeric_limits<streamsize>::max(), '\n'); 
                cout << "Input tidak valid. Silakan masukkan angka positif." << endl;
            } else {
                cin.ignore(numeric_limits<streamsize>::max(), '\n'); 
                return value; 
            }
        }
    };

    alas = getInput("Masukkan alas segitiga: ");
    tinggi = getInput("Masukkan tinggi segitiga: ");

    luas = 0.5 * alas * tinggi;

    cout << "Luas segitiga dengan alas " << alas << " dan tinggi " << tinggi << " adalah: " << luas << endl;

    return 0;
}
