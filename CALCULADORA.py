print("=== CALCULADORA ===")
print("1. Soma (+)")
print("2. Subtração (-)")
print("3. Multiplicação (*)")
print("4. Divisão (/)")

opcao = input("Escolha uma opção (1-4): ")

num1 = float(input("Digite o primeiro número: "))
num2 = float(input("Digite o segundo número: "))

if opcao == '1':
    print("Resultado:", num1 + num2)
elif opcao == '2':
    print("Resultado:", num1 - num2)
elif opcao == '3':
    print("Resultado:", num1 * num2)
elif opcao == '4':
    if num2 != 0:
        print("Resultado:", num1 / num2)
    else:
        print("Erro: Não é possível dividir por zero.")
else:
    print("Opção inválida.")