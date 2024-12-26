import sys
import os

def create_vhost_config(domain, path):
    # Template for Apache VirtualHost
    vhost_template = f"""<VirtualHost *:80>
        ServerName {domain}
        ServerAdmin webmaster@localhost
        DocumentRoot {path}
        
        ErrorLog ${{APACHE_LOG_DIR}}/error.log
        CustomLog ${{APACHE_LOG_DIR}}/access.log combined
</VirtualHost>
"""
    
    # Define the path to the sites-available directory
    sites_available_dir = "/etc/apache2/sites-available"

    # Create the configuration file path based on the domain
    config_file_path = os.path.join(sites_available_dir, f"{domain}.conf")

    try:
        # Write the configuration to the file
        with open(config_file_path, "w") as config_file:
            config_file.write(vhost_template)
        return (f"Configuration saved to {config_file_path}")
    except Exception as e:
        return (f"Failed to write configuration: {e}")

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python script.py <domain> <path>")
        sys.exit(1)

    domain = sys.argv[1]
    path = sys.argv[2]

    if not os.path.isdir(path):
        print(f"Error: The provided path '{path}' does not exist.")
        sys.exit(1)

    create_vhost_config(domain, path)
