#include <iostream>
#include <limits>
#include <cmath> 

using namespace std;

int main() {
    float jariJari, keliling;

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

    jariJari = getInput("Masukkan jari-jari lingkaran: ");

    keliling = 2 * M_PI * jariJari;

    cout << "Keliling lingkaran dengan jari-jari " << jariJari << " adalah: " << keliling << endl;

    return 0;
}
