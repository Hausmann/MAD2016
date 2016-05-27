using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace Einsatzplanung.API.Models
{
    [Table("azubis")]
    public class Azubi
    {
        [Key]
        [Column("azubiID")]
        public int AzubiID { get; set; }

        [Column("vorname")]
        public string Vorname { get; set; }

        [Column("nachname")]
        public string Nachname { get; set; }

        [Column("berufID")]
        public int BerufID { get; set; }

        [Column("ausbilderID")]
        public int AusbilderID { get; set; }

        [Column("heimatabteilungID")]
        public int HeimatabteilungID { get; set; }
        
        public int PersNr { get; set;}

    }
}