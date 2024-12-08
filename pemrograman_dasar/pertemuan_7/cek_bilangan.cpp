#include <iostream>
#include <string>
#include <sstream>

using namespace std;

bool isInteger(const string& str) {
    for (char c : str) {
        if (!isdigit(c) && c != '-') {
            return false;
        }
    }
    return true;
}

bool isFloat(const string& str) {
    bool hasDecimalPoint = false;
    for (char c : str) {
        if (!isdigit(c)) {
            if (c == '.' && !hasDecimalPoint) {
                hasDecimalPoint = true;
            } else if (c != '-' && c != '+') {
                return false;
            }
        }
    }
    return hasDecimalPoint;
}

int main() {
    string input;

    cout << "Masukkan sebuah angka: ";
    cin >> input;

    if (isInteger(input)) {
        cout << input << " adalah bilangan bulat." << endl;
    } else if (isFloat(input)) {
        cout << input << " adalah bilangan pecahan." << endl;
    } else {
        cout << input << " bukan bilangan bulat atau pecahan." << endl;
    }

    return 0;
}
