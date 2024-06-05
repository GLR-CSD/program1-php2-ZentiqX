<?php
// Set strict types
declare(strict_types=1);

class Persoon {
    /** @var int|null Het ID van de persoon */
    private ?int $id;

    /** @var string De voornaam van de persoon */
    private string $naam;

    /** @var string De achternaam van de persoon */
    private string $artiesten;

    /** @var string|null Het telefoonnummer van de persoon */
    private ?string $release_datum;

    /** @var string|null Het e-mailadres van de persoon */
    private ?string $url;

    /** @var string|null Eventuele opmerkingen over de persoon */
    private ?string $afbeelding;

    /** @var string|null Eventuele opmerkingen over de persoon */
    private ?string $prijs;

    /**
     * Constructor voor het maken van een Persoon object.
     *
     * @param int|null $id Het ID van de persoon.
     * @param string $naam De voornaam van de persoon.
     * @param string $artiesten De achternaam van de persoon.
     * @param string|null $release_datum Het telefoonnummer van de persoon (optioneel).
     * @param string|null $url Het e-mailadres van de persoon (optioneel).
     * @param string|null $afbeelding Eventuele opmerkingen over de persoon (optioneel).
     * * @param string|null $prijs Eventuele opmerkingen over de persoon (optioneel).
     */
    public function __construct(?int $id, string $naam, string $artiesten, ?string $release_datum,
                                ?string $url, ?string $afbeelding, ?string $prijs)

    {
        $this->id = $id;
        $this->naam = $naam;
        $this->artiesten = $artiesten;
        $this->release_datum = $release_datum;
        $this->url = $url;
        $this->afbeelding = $afbeelding;
        $this->prijs = $prijs;
    }

    /**
     * Haalt alle personen op uit de database.
     *
     * @param PDO $db De PDO-databaseverbinding.
     * @return Persoon[] Een array van Persoon-objecten.
     */
    public static function getAll(PDO $db): array
    {
        // Voorbereiden van de query
        $stmt = $db->query("SELECT * FROM album");

        // Array om personen op te slaan
        $album = [];

        // Itereren over de resultaten en personen toevoegen aan de array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album = new album(
                $row['id'],
                $row['naam'],
                $row['artiesten'],
                $row['release_datum'],
                $row['url'],
                $row['afbeelding'],
                $row['prijs']
            );
            $album[] = $album;
        }

        // Retourneer array met personen
        return $album;
    }

    /**
     * Zoek personen op basis van id.
     *
     * @param PDO $db De PDO-databaseverbinding.
     * @param int $id Het unieke ID van een persoon waarnaar we zoeken.
     * @return Persoon|null Het gevonden Persoon-object of null als er geen overeenkomstige persoon werd gevonden.
     * */
    public static function findById(PDO $db, int $id): ?album
    {
        // Voorbereiden van de query
        $stmt = $db->prepare("SELECT * FROM persoon WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Retourneer een persoon als gevonden, anders null
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new album(
                $row['id'],
                $row['naam'],
                $row['artiesten'],
                $row['release_datum'],
                $row['url'],
                $row['afbeelding'],
                $row['prijs']
            );
        } else {
            return null;
        }
    }

    /**
     * Zoek personen op basis van achternaam.
     *
     * @param PDO $db De PDO-databaseverbinding.
     * @param string $achternaam De achternaam om op te zoeken.
     * @return array Een array van Persoon objecten die aan de zoekcriteria voldoen.
     */
    public static function findByAchternaam(PDO $db, string $achternaam): array
    {
        //Zet de achternaam eerst om naar lowercase letters
        $naam = strtolower($naam);

        // Voorbereiden van de query
        $stmt = $db->prepare("SELECT * FROM persoon WHERE LOWER(naam) LIKE :naam");

        // Voeg wildcard toe aan de achternaam
        $naam = "%$naam%";

        // Bind de achternaam aan de query en voer deze uit
        $stmt->bindParam(':naam', $naam);
        $stmt->execute();

        // Array om personen op te slaan
        $album = [];

        // Itereren over de resultaten en personen toevoegen aan de array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album[] = new Persoon(
                $row['id'],
                $row['naam'],
                $row['artiesten'],
                $row['release_datum'],
                $row['url'],
                $row['afbeelding'],
                $row['prijs']
            );
        }

        // Retourneer array met personen
        return $album;
    }

    // Methode om een nieuwe persoon toe te voegen aan de database
    public function save(PDO $db): void
    {
        // Voorbereiden van de query
        $stmt = $db->prepare("INSERT INTO persoon (naam, artiesten, release_datum, url, afbeelding, prijs) VALUES (:naam, :artiesten, :release_datum, :url, :afbeelding, :prijs)");
        $stmt->bindParam(':naam', $this->naam);
        $stmt->bindParam(':artiesten', $this->artiesten);
        $stmt->bindParam(':release_datum', $this->release_datum);
        $stmt->bindParam(':url', $this->url);
        $stmt->bindParam(':afbeelding', $this->afbeelding);
        $stmt->bindParam(':prijs', $this->prijs);
        $stmt->execute();
    }

    // Methode om een bestaande persoon bij te werken op basis van ID
    public function update(PDO $db): void
    {
        // Voorbereiden van de query
        $stmt = $db->prepare("UPDATE persoon SET voornaam = :voornaam, achternaam = :achternaam, telefoonnummer = :telefoonnummer, email = :email, opmerkingen = :opmerkingen WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':naam', $this->voornaam);
        $stmt->bindParam(':artiesten', $this->achternaam);
        $stmt->bindParam(':release_datum', $this->telefoonnummer);
        $stmt->bindParam(':url', $this->email);
        $stmt->bindParam(':afb ', $this->opmerkingen);
        $stmt->execute();
    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoornaam(): string
    {
        return $this->voornaam;
    }

    public function getAchternaam(): string
    {
        return $this->achternaam;
    }

    public function getTelefoonnummer(): ?string
    {
        return $this->telefoonnummer;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getOpmerkingen(): ?string
    {
        return $this->opmerkingen;
    }

    // Setters
    public function setVoornaam(string $voornaam): void
    {
        $this->voornaam = $voornaam;
    }

    public function setAchternaam(string $achternaam): void
    {
        $this->achternaam = $achternaam;
    }

    public function setTelefoonnummer(string $telefoonnummer): void
    {
        $this->telefoonnummer = $telefoonnummer;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setOpmerkingen(string $opmerkingen): void
    {
        $this->opmerkingen = $opmerkingen;
    }
}
