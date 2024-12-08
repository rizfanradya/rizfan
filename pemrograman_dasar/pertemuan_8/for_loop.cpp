#include <iostream>
using namespace std;

int main() {
    char x = 10;
    
    // 1 -10
    for (int i = 1; i <= x; i++) {
        cout << i << endl;
    }
    cout << endl;
    
    // 10 - 1
    for (int i = x; i >= 1; i--) {
        cout << i << endl;
    }
    cout << endl;

    // segitiga
    for (int i = 1; i <= x; i++) {
        for (int j = 1; j <= i; j++) {
            cout << "*";
        }
        cout << endl;
    }
    for (int i = x; i >= 1; i--) {
        for (int j = 1; j <= i; j++) {
            cout << "*";
        }
        cout << endl;
    }
    cout << endl;
    
    // jajar genjang
    int n = 8;
    int m = 20;

    for (int i = 1; i <= n; i++) {
        for (int j = 1; j < i; j++) {
            cout << " ";
        }

        for (int j = 1; j <= m; j++) {
            cout << "*";
        }

        cout << endl;
    }

    cout << endl;
    return 0;
}