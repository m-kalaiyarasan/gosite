import os

def find_index_file(search_path):
    """
    Searches for a directory containing an 'index' file (e.g., index.html, index.php, etc.).
    Args:
        search_path (str): Path to search for the index file.
    Returns:
        str: Directory path containing the index file, or a message if not found.
    """
    index_files = {"index.html", "index.php", "index.js"}  # Add more as needed

    for root, dirs, files in os.walk(search_path):
        for file in files:
            if file in index_files:
                return os.path.abspath(root)
    return 0

def main(search_path):
    """
    Main function to validate input and find the index file.
    Args:
        search_path (str): Path to search for the index file.
    Returns:
        str: Output message indicating the result of the search.
    """
    if not os.path.isdir(search_path):
        return f"Error: {search_path} is not a valid directory."
    
    result = find_index_file(search_path)
    if result == 0:
        return result
    else:
        return result

if __name__ == "__main__":
    import sys
    
    # Check for correct usage
    if len(sys.argv) != 2:
        print("Usage: python3 fileName.py path/to/search")
        sys.exit(1)
    
    search_path = sys.argv[1]
    output = main(search_path)
    print(output)  # Print the result to the console
