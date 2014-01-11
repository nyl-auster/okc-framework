<?php
namespace okc\packages; 

/**
 * List existing vendors and packages, and packages config files.
 */
class packages {

  protected $packagesDirectory = '';

  /**
   * @param string $packagesDirectory
   *   name of directory containing all packages
   * @param string $packageConfigDirectory
   *   name of directory containing config files inside each packages
   */
  function __construct($packagesDirectory) {
    $this->packagesDirectory = $packagesDirectory;
  }

  /**
   * Return array of instancied module object, if they are "enabled".
   * @param list_disabled (bool)
   * if TRUE, list also disabled modules.
   */
  function getList($list_disabled = FALSE) {

    // static cache for packages.
    if (!empty($packages)) {
      return $packages;
    }

    static $packages = array();

    // scan vendors
    if ($directoryVendors = opendir($this->packagesDirectory)) {
      while (FALSE !== ($vendor = readdir($directoryVendors))) {
        if (!in_array($vendor, array('.', '..'))) {

          // scan packages
          if ($directoryPackage = opendir("$this->packagesDirectory/$vendor")) {
            while (FALSE !== ($package = readdir($directoryPackage))) {
              if (!in_array($package, array('.', '..'))) {

                $packageId = "$vendor.$package";
                $packages[$packageId] = array(
                  'name' => $package,
                  'vendor' => $vendor,
                  'path' => "$this->packagesDirectory/$vendor/$package",
                );

              }
            }
          } // end scan each vendor directory


        }
      }
    } // end scan packages directory

    closedir($directoryPackage);
    closedir($directoryVendors);
    return $packages;
  }

}

