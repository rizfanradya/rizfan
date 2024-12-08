#include <iostream>
using namespace std;

int main() {
    int n;
    int a = 0, b = 1;
    
    cout << "Masukkan jumlah deret Fibonacci: ";
    cin >> n;
    
    cout << "Deret Fibonacci: ";
    do {
        cout << a << " ";
        int temp = a;
        a = b;
        b = temp + b;
        n--;
    } while (n > 0);
    
    return 0;
}
