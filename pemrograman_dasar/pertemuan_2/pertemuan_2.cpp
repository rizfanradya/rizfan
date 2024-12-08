#include <iostream>
#include <string>
#include <limits>

using namespace std;

int main() {
    int bill1, bill2, bill3;
    string operate;

    auto getInput = [](const string& prompt) -> int {
        int value;
        while (true) {
            cout << prompt;
            cin >> value;
            if (cin.fail()) { 
                cin.clear(); 
                cin.ignore(numeric_limits<streamsize>::max(), '\n'); 
                cout << "Input tidak valid. Silakan masukkan angka bulat." << endl;
            } else {
                cin.ignore(numeric_limits<streamsize>::max(), '\n'); 
                return value; 
            }
        }
    };

    bill1 = getInput("Masukkan bilangan 1: ");
    bill2 = getInput("Masukkan bilangan 2: ");

    while (true) {
        cout << "Masukkan operator (+, -, *, /): ";
        cin >> operate;

        if (operate == "+" || operate == "-" || operate == "*" || operate == "/") {
            break; 
        } else {
            cout << "Operator tidak valid. Silakan masukkan operator yang benar." << endl;
        }
    }

    if (operate == "+") {
        bill3 = bill1 + bill2;
    } else if (operate == "-") {
        bill3 = bill1 - bill2;
    } else if (operate == "*") {
        bill3 = bill1 * bill2;
    } else if (operate == "/") {
        if (bill2 != 0) {
            bill3 = bill1 / bill2;
        } else {
            cout << "Error: Pembagian dengan nol tidak diperbolehkan." << endl;
            return 1; 
        }
    }

    cout << "Hasil dari " << bill1 << " " << operate << " " << bill2 << " = " << bill3 << endl;

    return 0;
}