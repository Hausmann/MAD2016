using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace Einsatzplanung.API.Models
{
    [Table("einsatze")]
    public class Einsaetze
    {
        [Key]
        [Column("einsatzID")]
        public int einsatzId { get; set; }

        [Column("abteilungID")]
        public int abteilungID { get; set; }

        [Column("azubiID")]
        public int azubiID { get; set; }

        [Column("vonDatum")]
        public string vonDatum { get; set; }

        [Column("bisDatum")]
        public string bisDatum { get; set; }

        [Column("status")]
        public string status { get; set; }
    }
}