import pandas as pd
pd.set_option('display.max_rows', None)
df = pd.read_csv('geodata.csv', delimiter=',')
df.columns = map(str.lower, df.columns)

print("\n*** Welcome! Please type '--help' for a list of commands! *** \n")

def main():
    confirm = True
    no_col = 'Column not found'

#startup prompt
    command = raw_input('What would you like to do?: ')

    while confirm == True:
#help command list
        if command == str('--help'):
            print("\n** Here are the commands you can use: \n**\n"
                  "** 'quit'      -- Exit the program \n"
                  "** 'mean'      -- Calculate mean of specific column \n"
                  "** 'median'    -- Calculate median of specific column \n"
                  "** 'print'     -- Prints the entire data sheet \n"
                  "** 'print col' -- Prints a specific column \n"
                  "** 'combine'   -- Adds together the contents of two columns \n")
            return main()
#quit command
        if command == str('quit'):
            stop = raw_input('Are you sure? y/n: ')
            if stop.lower() not in ('n', 'no'):
                quit()
            else:
                return main()
#find mean of specific column and set as global variable
        if command == str('mean'):
            col_avg = raw_input('Which column (by name)?: ')
            if col_avg not in df.columns:
                print(no_col)
                continue
            else:
                global mean_store
                mean_store = df[col_avg].mean()
                print(mean_store)
#find median of specific column and set as global variable
        if command == str('median'):
            col_median = raw_input('Which column (by name)?: ')
            if col_median not in df.columns:
                print(no_col)
                continue
            else:
                global med_store
                med_store = df[col_median].median()
                print(med_store)
#print dataframe
        if command == str('print'):
            print(df.iloc[0:125,0:16])
        if command == str('print col'):
            col_print = raw_input('Which column (by name)?: ')
            if col_print not in df.columns:
                print(no_col)
                continue
            else:
                print(df[col_print])
        if command == str('print mean'):
            print(mean_store)
        if command == str('print median'):
            print(med_store)
#combining data from columns
        if command == str('combine'):
            try:
                col_1, col_2 = raw_input('Which columns (by name)?: ').split(' ')
                if col_1 and col_2 not in df.columns:
                    print(no_col)
                    continue
            except ValueError:
                print('Please enter two columns!')
                continue
            else:
                global comb_store
                comb_store = df[col_1] + df[col_2]
                print(comb_store)
#ask user if they'd like to continue
        confirm = raw_input('Would you like to continue? y/n?: ')
        if confirm.lower() in ('n', 'no'):
            confirm = False
        else:
            return main()
        


main()
